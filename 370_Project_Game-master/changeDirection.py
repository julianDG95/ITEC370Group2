## Python file that changes the 'size' variable for each target in a JSON file.
## Takes in String to check for a regular expresssion
## Retrieves bounds for size from regex and creates value based on validity.
## Preconditions: String must be in form direction,direction,direction...
import random
import json
import sys

def getDirectionValueFromString(str):
    if ',' in str: 
        splitList = str.split(',')
    else:
        splitList = str # Single allowed direction, large distances can cause problems
    return splitList

jsonFile = open('targetFile.json', 'r')
data = json.load(jsonFile)            # Cursor at end of JSON file
jsonFile.close()                      # Close the JSON file, this removing the cursor

i = 0
userIn = getDirectionValueFromString(sys.argv[1])

if ',' in sys.argv[1]
    for n in data:
    	rand = random.randInt(0, len(userIn))
        data[i]["DIR"] = userIn[rand]
        i = i + 1
else 
    for n in data:
        data[i]["DIR"] = userIn
        i = i + 1

jsonFile = open('targetFile.json', 'w+')
jsonFile.write(json.dumps(data))
jsonFile.close()