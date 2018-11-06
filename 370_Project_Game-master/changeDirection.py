## Python file that changes the 'size' variable for each target in a JSON file.
## Takes in String to check for a regular expresssion
## Retrieves bounds for size from regex and creates value based on validity.
## Preconditions: String must be in form direction,direction,direction...
import random
import json
import sys

def getDistanceValueFromString(str):
    if ',' in str:
        splitList = str.split(',') 
    else:  ## Only one direction supplied
        splitList str
    return splitList

jsonFile = open('testFile.json', 'r') # Open the JSON file for reading
data = json.load(jsonFile)            # Read the JSON into the buffer
jsonFile.close()                      # Close the JSON file

## Working with buffered content
i = 0
directionList = getDistanceValueFromString(sys.argv[1])
dirLength = len(directionList)
for n in data:
    r = random.randint(0,dirLength-1)
    data[i]["DIR"] = directionList[r]
    i = i + 1
## Error check
## If error encountered return false, no write preformed
## Save our changes to JSON file
jsonFile = open('testFile.json', 'w+')
jsonFile.write(json.dumps(data))
jsonFile.close()