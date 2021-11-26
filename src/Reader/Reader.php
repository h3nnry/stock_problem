<?php

declare(strict_types=1);

namespace App\Reader;

use App\Reader\Interfaces\ReaderInterface;
use App\Reader\Interfaces\OfferCollectionInterface;
use Exception;

/**
 * Class Reader
 * @package App\Reader
 */
class Reader implements ReaderInterface
{
    const FORMAT_JSON = 'json';
    const FORMAT_CSV = 'csv';
    const FORMAT_XML = 'xml';

    public function __construct(
        private string $format
    ) {}

    /**
     * @param string $input
     * @return OfferCollectionInterface
     */
    public function read(string $input): OfferCollectionInterface
    {
        $offers = new OfferCollection();
        $data = [];
        try {

            $formatData = file_get_contents($input);
            if ($formatData !== false) {
                switch ($this->format) {
                    case self::FORMAT_JSON:
                        $data = json_decode($formatData, true);
                        if (JSON_ERROR_NONE !== json_last_error()) {
                            $data = [];
                        }
                        break;
                    case self::FORMAT_CSV:
                        $lines = explode(PHP_EOL, $formatData);
                        foreach ($lines as $line) {
                            $data[] = str_getcsv($line);
                        }
                        break;
                    case self::FORMAT_XML:
                        $xmlData = simplexml_load_string($formatData);
                        if ($xmlData !== false) {
                            $xmlOffers = $xmlData->offers;
                            foreach($xmlOffers as $xmlOffer) {
                                $data[] = $xmlOffer;
                            }
                        }
                        break;
                }
            }

        } catch (Exception $e) {
            // Handle exception
        }

        $offers->addMultiple($data);

        return $offers;
    }
}
