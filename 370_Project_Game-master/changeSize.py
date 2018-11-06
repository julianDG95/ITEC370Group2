## Python file that changes the 'size' variable for each target in a JSON file.
## Takes in String to check for a regular expresssion
## Retrieves bounds for size from regex and creates value based on validity.]
## Preconditions: Must be in form '0.0-0.5'
import random
import json
import sys

def getSizeValueFromString(str):
    if '-' in str: 
        splitList = str.split('-')
    else:
        splitList = str
    return splitList

jsonFile = open('targetFile.json', 'r')
data = json.load(jsonFile)            # Cursor at end of JSON file
jsonFile.close()                      # Close the JSON file, this removing the cursor

i = 0
userIn = getSizeValueFromString(sys.argv[1])
str = sys.argv[1]

if '-' in str:
    min = float(userIn[0])
    max = float(userIn[1])
    for n in data:
        data[i]["SIZE"] = round(random.uniform(min,max), 1)
        i = i + 1
else:
    for n in data:
        data[i]["SIZE"] = round(float(userIn), 1)
        i = i + 1

jsonFile = open('targetFile.json', 'w+')
jsonFile.write(json.dumps(data))
jsonFile.close()