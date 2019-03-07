<?php error_reporting(E_ERROR); ?>
<?php
    function getMapquestData($arrGetReq)
    {
        $varStreetAddress=$arrGetReq['varStreetAddress'] ?? null;
        $varZipCode=$arrGetReq['varZipCode'] ?? null;
        $varSicCode=$arrGetReq['varSicCode'] ?? null;
        $varSearchRadius=$arrGetReq['varSearchRadius'] ?? null;
        $varMapquestApiKey='IriKNa9PzduxFw0DNM33MWGCwlXgkwqA';
        $varOrigin=$varStreetAddress.',+'.$varZipCode;
        $arrData = array('origin'=>$varOrigin,
        'radius'=>$varSearchRadius,
        'maxMatches'=>'10',
        'ambiguities'=>'ignore',
        'hostedData'=>'mqap.ntpois|group_sic_code=?|'.$varSicCode,
        'outFormat'=>'json',
        'key'=>$varMapquestApiKey
        );

        $q=http_build_query($arrData);


        $url='https://www.mapquestapi.com/search/v2/radius?'.$q;
        $arrResult = json_decode(file_get_contents($url,TRUE));
        $jsonResult=json_encode($arrResult,JSON_PRETTY_PRINT);
        return $jsonResult;

    }

    function getSearchResultsTable($arrResults)
    {
        $rslt="";

        $resultsCount=$arrResults['resultsCount'];

        if($resultsCount==0)
        {
            $rslt='<p>No stations found.</p>';
        }

        else
        {
            $boolShowTable=false;

            for($x=0;$x<$resultsCount;$x++)
            {
                $rslt .='<tr>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['resultNumber'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['distance'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['name'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['fields']['address'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['fields']['city'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['fields']['state'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['fields']['postal_code'].'</td>';
                $rslt .='<td>'.$arrResults['searchResults'][$x]['fields']['phone'].'</td>';
                $rslt .='</tr>';
            }

        }
        return $rslt;
    }

    function getTableStyle($boolShowTbl)
    {
        if ($boolShowTbl==true)
        {
            $style='display:initial';
        }
        else
        {
            $style='display:none';
        }
        return $style;
    }

    //Main Routine
        require 'classes/Form.php';
        use DWA\Form;

        $boolShowTable=false;
        $tblSearchResults=null;
        $arrSearchResults=array();

        if (isset($_GET) && !empty($_GET))
        {
            $arrGetRequest=$_GET;
            $form = new Form();
            $form.validate();
            $boolShowTable=true;
            $jsonSearchResults=getMapquestData($arrGetRequest);
            $arrSearchResults=json_decode($jsonSearchResults,true);
            $tblSearchResults=getSearchResultsTable($arrSearchResults);
            $tblStyle=getTableStyle($boolShowTable);
        }

        else
        {
            $tblStyle=getTableStyle($boolShowTable);
        }


?>
