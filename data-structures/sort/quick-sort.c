#include<stdio.h>

#define arraySize 10

void header();
void footer();
void arrayContent();
void arraySort(int[], int, int);

int main()
{
	int arr[] = {91, 15, 85, 13, 29, 62, 42, 36, 16, 53};
	header(); 

	printf("\n");
	printf("\n\t| Array Content [BEFORE SORTING]: \n\n\t\t");
	arrayContent(arr); 
	arraySort(arr, 0, arraySize-1);
	printf("\n\t| Array Content [AFTER SORTING]: \n\n\t\t");
	arrayContent(arr); 

	footer();      
	printf("\n");
	return 0;
}

void arraySort(int arr[], int start, int end)
{
	int index = start;
	int i, temp;
	int pivot = arr[end];
	if(start<end)
	{
		for(i=start; i<end; i++)
		{
			if(arr[i]<=pivot)
			{
				temp = arr[i];
				arr[i] = arr[index];
				arr[index] = temp;
				index++;
			}
		}
		temp = arr[index];
		arr[index] = arr[end];
		arr[end] = temp;
		arraySort(arr, start, index-1);
		arraySort(arr, index+1, end);
	}
}

void arrayContent(int arr[])
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
	printf("\t\tTitle: Quick Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}