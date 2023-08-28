#include<stdio.h>

#define arraySize 100
int arr[arraySize] = {91, 15, 85, 13, 29, 62, 42, 36, 16, 7, 
		      18, 66, 71, 25, 97, 45, 46, 43, 75, 4, 
		      23, 70, 12, 76, 30, 61, 50, 22, 19, 9, 
		      90, 83, 87, 68, 41, 21, 51, 72, 77, 5, 
		      60, 27, 98, 86, 39, 49, 54, 17, 96, 3,
		      48, 82, 99, 88, 33, 26, 35, 24, 14, 8,
		      78, 55, 58, 52, 79, 63, 95, 28, 53, 1,
		      74, 93, 84, 57, 59, 47, 44, 20, 31, 2,
		      81, 10, 89, 32, 80, 69, 65, 37, 56, 6, 
		      38, 92, 67, 94, 40, 11, 34, 64, 73, 100};

void header();
void footer();
void arrayContent();
int displayResult(int, int, int, int);

int main()
{
	header(); // Displays the header
	int num;
	printf("\n\n\t| Enter a number to search: ");
	scanf("%d", &num);
	arrayContent();  // Displays the content of the array
	int location;
	int found = 0;
	int count = 1;
	for(int i=0; i<arraySize; i++)
	{
		if(num==arr[i])
		{
			found++;
			location = i;
			break;
		}
		count++;
	}
	displayResult(num, found, location, count); // Passes the values of cited 
	footer(); // Displays the footer            // variables to displayResult()
	printf("\n");
	return 0;
}

int displayResult(int num, int found, int location, int count)
{
	printf("\n\t| Number to be search: %d", num);
	if(found!=0)
	{
		printf("\n\t| The search found %d in the list.", num);
		printf("\n\t| Location of %d in the array: arr[%d]", num, location);
		printf("\n\t| Searches Made: %d", count);
	}
	else
	{
		printf("\n\t| %d was not found.", num);
		printf("\n\t| Searches Made: %d", count);
	}
}

void arrayContent()
{
	int ten = 1;
	printf("\n\t| Array Content: \n\n\t\t[01] ");
	for(int i=0; i<arraySize; i++)
	{
		ten++;
		if(i==9 || i==19 || i==29 || i==39 ||
	      i==49 || i==59 || i==69 || i==79 ||
	      i==89 || i==99)
		{
			if(i!=99)
				printf("%d \n\t\t[%d] ", arr[i], ten);
			else
				printf("%d \n\t\t", arr[i]);
		}
		else
			printf("%d ", arr[i]);
	}
}

void header()
{
	printf("\n     ==================================================");
	printf("\n\t\tData Structures and Algorithm");
	printf("\n\tLesson: Searching");
	printf("\tTitle: Linear Search");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}
