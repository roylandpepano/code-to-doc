Code to Document and PDF Converter

This script is designed to convert source code files into a Microsoft Word (.docx) document and a PDF file. It is particularly useful for authors working on a thesis manuscript who want to include code samples within their document. By automating the conversion process, it saves time and effort in manually copying and formatting code snippets.

Features
Converts source code of a project into a well-formatted Microsoft Word document and a PDF file.
Facilitates the selection of code sections to be included in the thesis manuscript.
Accelerates the process of integrating code samples into the manuscript.
How to Use
Runtime Measurement: The runtime of the program is measured to provide an idea of its execution time.

Folder Path Input: The user is prompted to enter the filepath of the folder containing the source code files.

Document Creation: The script creates a new Microsoft Word document and sets the column layout to two columns.

Code Inclusion: It traverses through the specified folder and its subdirectories, opening each source code file. The code content is then transferred to the Word document.

Header Formatting: For each code file, a header is added to indicate the file's name. This header is stylized with Arial font, size 10, bold, italic, and underlined.

Code Formatting: The code lines are added to the document with a consistent format. Each line is styled with Arial font, size 9.

Saving Documents: The script saves the generated Word document with the same name as the input folder but with a ".docx" extension. It also converts the Word document to a PDF file for quicker viewing and reference.

Completion Message: Once the conversion process is complete, the script prints a success message along with the filenames of the generated .docx and .pdf files.

Program Runtime: The total runtime of the program is displayed at the end, indicating how long the conversion process took.

Dependencies
Python 3.x
Required Python packages:
os: For interacting with the operating system and handling file paths.
docx: For creating and formatting Microsoft Word documents.
time: For measuring program execution time.
docx2pdf: For converting the Word document to PDF format.

Instructions
Install the required Python packages if they are not already installed:
pip install python-docx docx2pdf

Run the script using a Python interpreter:
python script_name.py

Follow the prompts to enter the filepath of the folder containing the source code.

The script will generate a .docx file and a .pdf file with the same name as the input folder.

Author
Royland Pepaño
