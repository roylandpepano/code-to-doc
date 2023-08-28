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
	int insert;
	int pos;
	printf("\n\t| Array Content [DURING SORTING]: \n");
	for(int i=1; i<arraySize; i++)
	{
		printf("\n\t * Iteration (%d): ", i);
		printf("[ ");
		for(int a=0; a<arraySize; a++)
		  printf("%d ",arr[a]);
		printf("]\n");
		insert = arr[i];
		pos = i;
		while(pos > 0 && arr[pos-1]>insert)
		{
			arr[pos] = arr[pos-1];
			pos--;
			printf("\t\t* %d was moved to arr[%d].\n", arr[pos], i);
		}
		if(pos!=i)
		{
			printf("\t\t* %d was inserted at arr[%d].\n", insert, pos);
			arr[pos] = insert;
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
	printf("\t\tTitle: Insertion Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}