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
    			
			$lineArray = explode("/", $line); 
			$patternArray = explode("/", $pattern);

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
		
	
