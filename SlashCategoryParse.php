<?php

/*
 SlashCategory PHP Parser
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

function getData($data, $pattern)
{
	
	$foundData = false;
	$dataArray = array();	
	$dataArrayIteration = 0;
	

	$dataLineArray = explode("\n", $data);

	foreach($dataLineArray as &$line)
	{
		if (strpos($line,$pattern) !== false) {
    			
			$lineArray = explode("/", $line);
			$patternArray = explode("/", $pattern);

			$iteration = 0;
			

			$foundData = true;
	
			

			foreach($lineArray as $lineData)
			{
				if($patternArray[$iteration] == $lineData)
				{
					$iteration++;
				}
			elseif ($iteration == count($patternArray))
			{
				$dataArray[$dataArrayIteration] = $lineData;
				$dataArrayIteration++;
			
				break;
			}
			}


		
     
		
			

		}
	}

	return $dataArray;
}
		
	
