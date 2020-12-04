<?php

namespace App\Domain\Procurement\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Procurement\Dao\ProcurementDB;
use App\Domain\Employee\Dao\EmployeeDB;
use App\Domain\Procurement\Dao\MeubleDao;
use App\Domain\Vendor\Dao\VendorDB;

class MeubleService extends Controller
{
    private $meubles;

    public function __construct()
    {
        $this->meubles = new MeubleDao();
    }

    public function homeView()
    {
        $meubles = $this->meubles->findAllMeubles();
        return view('homecust', [
            'meubles' => $meubles,
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'modelType' => 'required',
            'meubleName' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'description' => 'required',
            'warranty' => 'required',
            'price' => 'required',
            'vendor' => 'required',
            'picture' => 'required'
        ]);
        $pict = $request->file('picture');
        //mendapatkan nama file/image
        $pictName = $pict->getClientOriginalName();
        //upload file ke folder yang disediakan
        $targetUploadDesc = "images\\sales\\meuble";
        $pict->move($targetUploadDesc, $pictName);
        //membuat file path yang akan digunakan sebagai src html
        $pathDesc = $targetUploadDesc . "\\" . $pictName;

        $this->meubles->insert($request, $pathDesc);
        return redirect()->back()->with('success_new_meuble', 'Meuble ' . $request->modelType . ': ' . $request->meubleName . ' created success!');
    }

    //mengambil data mebel yang sudah ada untuk field create PO
    public function generateMeubleForProcurement()
    {
        if ($_GET["source_url"] == 'salesorder') {
            $meuble = $this->meubles->findMeubleByModelType($_GET);
        } else {
            $meuble = $this->meubles->findMeubleByModelTypeAndVendor($_GET);
        }

        if (isset($meuble)) {
            return $meuble;
        }

        return json_encode($meuble);
    }
}
