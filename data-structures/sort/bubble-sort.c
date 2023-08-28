#include<stdio.h>
#include<stdbool.h>

#define arraySize 10
int arr[arraySize] = {91, 15, 85, 13, 29, 62, 42, 36, 16, 53};

void header();
void footer();
void arrayContent();
void arrayDuringSorting();

int main()
{
	header();

	printf("\n");
	printf("\n\t| Array Content [BEFORE SORTING]: \n\n\t\t");
	arrayContent(); 
	arrayDuringSorting(); // Sorting method
	printf("\n\t| Array Content [AFTER SORTING]: \n\n\t\t");
	arrayContent(); 

	footer();     
	printf("\n");
	return 0;
}

void arrayDuringSorting()
{
	int temp;
	bool swapped = false;
	printf("\n\t| Array Content [DURING SORTING]: \n");
	for(int i=0; i<(arraySize-1); i++)
	{
		printf("\n\t * Iteration (%d): ",(i+1));
		printf("[ ");
		for(int a=0; a<arraySize; a++)
		  printf("%d ",arr[a]);
		printf("]\n");
		swapped = false;
		for(int j=0; j<((arraySize-1)-i); j++)
		{
			printf("\t    Items compared: [ %d, %d ] ", arr[j], arr[j+1]);
			if(arr[j]>arr[j+1])
			{
				temp = arr[j];
				arr[j] = arr[j+1];
				arr[j+1] = temp; 

				swapped = true;
				printf("=> swapped (%d, %d)\n",arr[j], arr[j+1]);
			}
			else
				printf("=> not swapped\n");
		}
		if(!swapped)
        	break;
	}
}

void arrayContent()
{
	for(int i=0; i<arraySize; i++)
	{
		printf("%d ", arr[i]);
	}
	printf("\n");
}

void header()
{
	printf("\n     ==================================================");
	printf("\n\t\tData Structures and Algorithm");
	printf("\n\tLesson: Sorting");
	printf("\t\tTitle: Bubble Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}