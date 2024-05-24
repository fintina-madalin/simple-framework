<?php

namespace App\Services;

class GeneratorService
{
    public function generateXml(array $data): string
    {
        $xml = new \SimpleXMLElement('<root/>');

        foreach ($data as $item) {
            $record = $xml->addChild('record');
            foreach ($item as $key => $value) {
                $record->addChild($key, htmlspecialchars($value));
            }
        }

        return $xml->asXML();
    }

    public function generateCsv(array $data): string
    {
        $output = fopen('php://temp', 'r+');

        if (!empty($data)) {
            fputcsv($output, array_keys((array) $data[0]));
        }

        foreach ($data as $item) {
            fputcsv($output, (array) $item);
        }

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        return $csvContent;
    }
}