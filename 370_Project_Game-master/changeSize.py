## Python file that changes the 'size' variable for each target in a JSON file.
## Takes in String to check for a regular expresssion
## Retrieves bounds for size from regex and creates value based on validity.
import random
import json
import sys

def getDistanceValueFromString(str):
    if ',' in str:
        splitList = str.split(',') 
    elif '-' in str: 
        splitList = str.split('-')
    else:
        splitList = str
    return splitList

jsonFile = open('testFile.json', 'r') # Open the JSON file for reading
data = json.load(jsonFile)            # Read the JSON into the buffer
jsonFile.close()                      # Close the JSON file

## Working with buffered content
i = 0
numList = getDistanceValueFromString(sys.argv[1])
if len(numList) = 1
    for n in data
    	data[i]["SIZE"] = numList[0]
    	i = i + 1
    i = 0 
if len(numList) != 1
	for n in data:
    	data[i]["SIZE"] = random.randint(int(numList[0]),int(numList[1]))
    	i = i + 1
## Error check - on fail write changes

## Save our changes to JSON file
jsonFile = open('testFile.json', 'w+')
jsonFile.write(json.dumps(data))
jsonFile.close()