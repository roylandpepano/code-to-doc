import os
from docx import Document

# Get the filepath of the folder
mainFolderPath = input("Enter the filepath of the folder: ")

# Create a document
document = Document()

# Store the filepaths in the file
for path, subdirs, files in os.walk(mainFolderPath):
    for pathFile in files:
        pathFile = os.path.join(path, pathFile)
        srcFile = open(pathFile, "r+")
        for line in srcFile:
            paragraph = document.add_paragraph(line)

document.save('codes.docx')