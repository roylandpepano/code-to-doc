#include<stdio.h>

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
	int min;
	printf("\n\t| Array Content [DURING SORTING]: \n");
	for(int i=0; i<(arraySize-1); i++)
	{
		printf("\n\t * Iteration (%d): ", i+1);
		printf("[ ");
		for(int a=0; a<arraySize; a++)
		  printf("%d ",arr[a]);
		printf("]\n");

		min = i;
		for(int j=i+1; j<arraySize; j++)
		{
			if(arr[j]<arr[min])
				min = j;
			
		}
		if(min!=i)
		{
			printf("\t\tItems Swapped: [%d, %d]\n", arr[i], arr[min]);
			int temp = arr[min];
			arr[min] = arr[i];
			arr[i] = temp;
		}
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
	printf("\t\tTitle: Selection Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}