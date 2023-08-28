#include<stdio.h>

#define arraySize 10

void header();
void footer();
void arrayContent();
void arraySort(int[], int, int);
void arrayMerge(int[], int, int, int);

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
	if(start<end)
	{
		int mid = (start + end)/2;
		arraySort(arr, start, mid);
		arraySort(arr, mid+1, end);
		arrayMerge(arr, start, mid, end);
	}
}

void arrayMerge(int arr[], int start, int mid, int end)
{
	int i = start;
	int j = mid+1;
	int k, index = start;
	int temp[arraySize];

	while(i<=mid && j<=end)
	{
		if(arr[i]<arr[j])
		{
			temp[index] = arr[i];
			i+=1;
		}
		else
		{
			temp[index] = arr[j];
			j+=1;
		}
		index++;
	}

	if(i>mid)
	{
		while(j<=end)
		{
			temp[index] = arr[j];
			index++;
			j++;
		}
	}
	else
	{
		while(i<=mid)
		{
			temp[index] = arr[i];
			index++;
			i++;
		}
	}
	k = start;
	while(k<index)
	{
		arr[k] = temp[k];
		k++;
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
	printf("\t\tTitle: Merge Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}