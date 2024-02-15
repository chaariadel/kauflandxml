<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleXMLElement;
use PDF;
use Illuminate\Support\Facades\Storage;

class XmlController extends Controller
{
    public function AjoutXML()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('/');
        } else {
            return view('Ajouter_XML');
        }
    }

    public function showSources()
{
    $sources = DB::table('xml_datas')->select('Source')->distinct()->get();
    $Sourcetotal = DB::table('xml_datas')->select('Source')->distinct()->count();
    return view('ListeSource', compact('sources','Sourcetotal'));
}

    public function importXml(Request $request)
    {
        $xmlContent = $request->input('xmlContent');
        $Source = $request->input('Source');

        $log = new Logger('xml-import');
        $log->pushHandler(new StreamHandler(storage_path('logs/xml-import.log'), Logger::ERROR));

        try {
            // Charger le contenu XML
            $xml = simplexml_load_string($xmlContent);

            foreach ($xml->children() as $element) {
                $data = $this->xmlToArray($element);
                $this->storeData($data, $Source);
            }

            $log->info('Importation XML réussie.');
            return 'Importation XML réussie.';
        } catch (\Exception $e) {
            $log->error('Erreur lors de l\'importation XML : ' . $e->getMessage());
            return 'Erreur lors de l\'importation XML : ' . $e->getMessage();
        }
    }

    private function xmlToArray(SimpleXMLElement $xml)
    {
        $array = [];

        foreach ($xml->children() as $element) {
            if ($element->count() > 0) {
                $array[Str::snake($element->getName())] = $this->xmlToArray($element);
            } else {
                $array[Str::snake($element->getName())] = (string) $element;
            }
        }

        return $array;
    }

    private function storeData($data,$Source)
    {
        DB::table('xml_datas')->insert([
            'xml_data' => json_encode($data),
            'Source'=>$Source,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



  

//     public function listexml()
// {
//     $donnees = DB::table('xml_datas')
//     ->where('xml_data->author', 'Garghentini, Davide')
//     ->get();
// return view('liste_donnees', ['donnees' => $donnees]);
// }

public function convertAndDownloadXml(Request $request)
{
    $source = $request->input('source');
    $donnees = DB::table('xml_datas')->where('Source', $source)->get();

    if ($donnees->isEmpty()) {
        abort(404);
    }

    $xmlString = '<root>';
    foreach ($donnees as $donnee) {
        $xmlString .= '<item>';
        $xmlString .= $this->arrayToXml(json_decode($donnee->xml_data, true));
        $xmlString .= '</item>';
    }
    $xmlString .= '</root>';

    // Set the desired filename for the downloaded XML file
    $filename = $source . '_data.xml';

    // Return the XML response for download
    return response($xmlString)
        ->header('Content-Type', 'text/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
}

public function convertAndDownloadPdf(Request $request)
{
    $source = $request->input('source');
    $donnees = DB::table('xml_datas')->where('Source', $source)->get();
    $Sourcetotal = DB::table('xml_datas')->where('Source', $source)->count();

    if ($donnees->isEmpty()) {
        abort(404);
    }

    $pdf = PDF::loadView('ListeSource', ['donnees' => $donnees],['Sourcetotal' => $Sourcetotal]);
    
    // Set the desired filename for the downloaded PDF file
    $filename = $source . '_data.pdf';

    // Return the PDF response for download
    return $pdf->download($filename);
}

public function convertAndDownloadCsv(Request $request)
{
    $source = $request->input('source');
    $donnees = DB::table('xml_datas')->where('Source', $source)->get();

    if ($donnees->isEmpty()) {
        abort(404);
    }

    $csvData = $donnees->toArray();

    // Set the desired filename for the downloaded CSV file
    $filename = $source . '_data.csv';

    // Return the CSV response for download
    return response()->stream(
        function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, array_keys((array) $csvData[0]));

            foreach ($csvData as $row) {
                fputcsv($handle, (array) $row);
            }

            fclose($handle);
        },
        200,
        [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]
    );
}




























public function convertAndDownloadXmlAll(Request $request)
{
    $source = $request->input('source');
    $donnees = DB::table('xml_datas')->get();

    if ($donnees->isEmpty()) {
        abort(404);
    }

    $xmlString = '<root>';
    foreach ($donnees as $donnee) {
        $xmlString .= '<item>';
        $xmlString .= $this->arrayToXml(json_decode($donnee->xml_data, true));
        $xmlString .= '</item>';
    }
    $xmlString .= '</root>';

    $filename = 'All_data.xml';
    return response($xmlString)
        ->header('Content-Type', 'text/xml')
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
}


private function arrayToXml($data, $xmlString = '')
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $xmlString .= "<$key>";
            $xmlString = $this->arrayToXml($value, $xmlString);
            $xmlString .= "</$key>";
        } else {
            $xmlString .= "<$key>" . htmlspecialchars($value) . "</$key>";
        }
    }
    
    return $xmlString;
}


public function showFeedData(Request $request)
{

    $source = $request->input('source');
    $sources =  DB::table('xml_datas')->where('Source', $source)->get();

    return view('liste_donnees', compact('sources'));
}
}
