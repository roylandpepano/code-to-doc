import os
import docx
from docx import Document
from docx.shared import Pt
from docx.oxml import OxmlElement
from docx.oxml.ns import qn

# Get the filepath of the folder
mainFolderPath = input("Enter the filepath of the folder: ")

# Create a document and set the column into 2
document = Document()
section = document.sections[0]
sectPr = section._sectPr
cols = sectPr.xpath('./w:cols')[0]
cols.set(qn('w:num'),'2')

# Open the files using their paths and transfer the content to docx
for path, subdirs, files in os.walk(mainFolderPath):
    for pathFile in files:
        pathFile = os.path.join(path, pathFile)
        fileName = os.path.basename(pathFile)
        srcFile = open(pathFile, "r+", encoding='UTF-8')

        # Add a header [filename.php]
        head = document.add_paragraph()
        head.paragraph_format.space_before = Pt(15)
        head.paragraph_format.space_after = Pt(15)
        head = head.add_run(fileName)
        fhead = head.font
        fhead.name = 'Arial'
        fhead.size = Pt(10)
        fhead.bold = True
        fhead.italic = True
        fhead.underline = True

        # Add the codes
        for line in srcFile:
            line = line.rstrip('\n')
            code = document.add_paragraph()
            code.paragraph_format.space_after = 0
            code = code.add_run(line)
            fcode = code.font
            fcode.name = 'Arial'
            fcode.size = Pt(9)

document.save('codes.docx')
print("codes.docx was successfully created!")