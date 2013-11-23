#!/usr/bin/env python2

#  SlashCategory Python Parser
#  PySlashCategory
#  Copyright 2013 Ian Duncan

#  Licensed under the Apache License, Version 2.0 (the "License");
#  you may not use this file except in compliance with the License.
#  You may obtain a copy of the License at
#
#      http://www.apache.org/licenses/LICENSE-2.0

#  Unless required by applicable law or agreed to in writing, software
#  distributed under the License is distributed on an "AS IS" BASIS,
#  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
#  See the License for the specific language governing permissions and
#  limitations under the License.

import string

if __name__ == "__main__":

	print "PySlashCategory"
	print
	print "A SlashCategory Parser For Python 2.7"
	print
	print "By Ian Duncan"
	


def getSlashCategoryData(data, pattern):

	dataArray = []

	#Add a / onto the pattern. Necessary for parsing
	pattern = pattern + "/"

	

	dataLineList = data.split("\n")
	

	for line in dataLineList:

		if line.startswith("#") == True:

			#Line is a comment
			#Do Nothing
			pass

		else:
			#Can we match the pattern to the data entry?
			if pattern in line:
			
				#First step in getting data. Remove pattern from data entry
				dataFound = line.replace(pattern, '')
				#Separate remaining pieces of data in data entry
				dataFoundList = dataFound.split("/")
				#We only need the first one
				dataArray.append(dataFoundList[0])

	return dataArray

def getSCPageTitle(data):

	return getSlashCategoryData(data, "Page/Title")[0]

def getSCPageAuthor(data):

	return getSlashCategoryData(data, "Page/Author")[0]

def getSCPageDesc(data):

	return getSlashCategoryData(data, "Page/Description")[0]

def getSCPageType(data):

	return getSlashCategoryData(data, "Page/Type")[0]

def getSCPageRequest(data):

	requestInfo = {
		'request':'',
		'reason':''
	}

	pageRequestStatus = getSlashCategoryData(data, "Page/Request/Status")[0]
	pageReasonStatus = getSlashCategoryData(data, "Page/Request/Status/" + pageRequestStatus)[0]

	requestInfo['request'] = pageRequestStatus
	requestInfo['reason'] = pageReasonStatus

	return requestInfo

	
		


		

				
   


