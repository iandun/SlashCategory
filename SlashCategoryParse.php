<?php

/*
 SlashCategory PHP Parser
 PHPSlashCategory
 Copyright 2013 Ian Duncan

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

//Extract info from SlashCategory Data
function getData($data, $pattern)
{
	
	$foundData = false; //Were data entries retrieved from the file
	$dataArray = array(); //Array of results
	$dataArrayIteration = 0;
	

	$dataLineArray = explode("\n", $data); //Get each data entry

	//Parse each data entry, look for data
	foreach($dataLineArray as &$line)
	{
		
		if(substr( $line, 0, 1 ) === "#") //Is the line a comment
		{
			//Comment. Don't Do Anything;
			;
		}
		else
		{
		if (strpos($line,$pattern) !== false) { //It's not a comment. Try to parse it.
    			
			//$lineArray = explode("/", $line);
			//$lineArray = preg_split("((?<!\\\)/)", $line);
			$lineArray = preg_split('|(?<!\\\)/|', $line);
			array_walk(
    				$lineArray,
   				 function(&$item){
        			return $item = str_replace('\\/', '/', $item);
    				}
			);
			//$patternArray = explode("/", $pattern);
			//$patternArray = preg_split("((?<!\\\)/)", $pattern);
			$patternArray = preg_split('|(?<!\\\)/|', $pattern);
			array_walk(
    				$patternArray,
   				 function(&$item){
        			return $item = str_replace('\\/', '/', $item);
    				}
			);

			$iteration = 0;
			

			$foundData = true; //Data was found
	
			

			foreach($lineArray as $lineData)
			{
				if($patternArray[$iteration] == $lineData)
				{
					$iteration++;
				}
			elseif ($iteration == count($patternArray))
			{
				$dataArray[$dataArrayIteration] = $lineData; //Found result. Add it to the array of results.
				$dataArrayIteration++;
			
				break;
			}
			}


		
     
		
			

		}
		}
	}

	return $dataArray; 
}

//Allows you to get Data title (found in Page/Title)
function getDataTitle($data)
{
		$dataTitle = getData($data, "Page/Title");
		return $dataTitle[0];
}

//Allows you to get Data description (found in Page/Description)
function getDataDescription($data)
{
	$dataDesc = getData($data, "Page/Description");
	return $dataDesc[0];
}

//Allows you to get the Data author (found in Page/Author)
function getDataAuthor($data)
{
	$dataAuthor = getData($data, "Page/Author");
	return $dataAuthor[0];
}

//Allows you to get the Data type (found in Page/Type)
function getDataType($data)
{
	$dataType = getData($data, "Page/Type");
	return $dataType[0];
}

//Allows you to see if reqeust failed or succeeded, and why
function getRequestInfo($data)
{
	//Array data:
	// request -> either 'succeeded' or 'failed'
	// reason -> why request succeeded or failed 
	$requestArray = array(
				"request" => "",
				"reason" => ""
				);
	$requestRequestArray = getData($data, "Page/Request/Status");
	$reasonRequestArray = getData($data, "Page/Request/Status/" . $reasonRequestArray[0]);
	$requestArray['request'] = $requestRequestArray[0];
	$requestArray['reason'] = $reasonRequestArray[0];
	
	return $requestArray;
	
	
}


		
	
