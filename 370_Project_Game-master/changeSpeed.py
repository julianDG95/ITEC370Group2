## Python file that changes the 'size' variable for each target in a JSON file.
## Takes in String to check for a regular expresssion
## Retrieves bounds for size from regex and creates value based on validity.
## Precondition: String must be form number-number
import random
import json
import sys

def getSpeedValueFromString(str):
    if '-' in str: 
        splitList = str.split('-')
    else:
        splitList = str
    return splitList

jsonFile = open('testFile.json', 'r')
data = json.load(jsonFile)            # cursor at end of JSON file
jsonFile.close()                      # Close the JSON file, this removing the cursor

i = 0
userIn = getSpeedValueFromString(sys.argv[1])

if '-' in userIn
    min = int(userIn[0])
    max = int(userIn[1])
    for n in data:
        data[i]["SPD"] = random.randint(min, max)
        i = i + 1
else 
    for n in data:
        data[i]["SPD"] = userIn
        i = i + 1

jsonFile = open('testFile.json', 'w+')
jsonFile.write(json.dumps(data))
jsonFile.close()