<?php
namespace App\Shop\Admin\Information\Services;

class InformationService
{    
    /**
     * Get system info
     *
     * @return array
     */
    public function getData(): array
    {
        $phpinfoDataArray = $this->parsePhpinfoToArray();
        $dataArray = ['serverInfo' => [
                        __('admin-information.server-info') . ' ' . $phpinfoDataArray['General']['System '],
                        __('admin-information.php') . ' ' . $phpinfoDataArray['Core']['PHP Version '],
                        __('admin-information.memory') . ' ' . $phpinfoDataArray['Core']['memory_limit']['local'],
                        __('admin-information.execute-time') . ' ' . $phpinfoDataArray['Core']['max_execution_time']['local'],
                        __('admin-information.max-upload-size') . ' ' . $phpinfoDataArray['Core']['max_file_uploads']['local'] . 'MB',
                    ],
                    'storeInfo' => [
                        __('admin-information.laravel-version') . ' ' . app()->version(),
                        __('admin-information.store-url') . ' ' . url('/'),
                        __('admin-information.current-template'),
                    ],
                    'clientAgent' => __('admin-information.client') . ' ' . $_SERVER["HTTP_USER_AGENT"],
        ];
        return $dataArray;
    }

    /**
     * Parsing phpinfo() to array
     *
     * @return array
     */
    private function parsePhpinfoToArray(): array
    {
        ob_start();
        phpinfo();
        $info_arr = array();
        $info_lines = explode("\n", strip_tags(ob_get_clean(), "<tr><td><h2>"));
        $cat = "General";
        foreach($info_lines as $line) {
            preg_match("~<h2>(.*)</h2>~", $line, $title) ? $cat = $title[1] : null;
            if(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
                $info_arr[$cat][$val[1]] = $val[2];
            }
            elseif(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
                $info_arr[$cat][$val[1]] = array("local" => $val[2], "master" => $val[3]);
            }
        }
        return $info_arr;
    }
}