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
	int inner, outer;
	int insert;
	int interval = 1;
	int elements = arraySize;
	int i = 0;
	printf("\n\t| Array Content [DURING SORTING]: \n");
	while(interval<=(elements/3))
		interval = interval * 3 + 1;
	while(interval>0)
	{
		printf("\n\t * Iteration (%d): ", i+1);
		printf("[ ");
		for(int a=0; a<arraySize; a++)
		  printf("%d ",arr[a]);
		printf("]\n");

		for(outer=interval; outer<elements; outer++)
		{
			insert = arr[outer];
			inner = outer;
			while(inner>(interval-1) && arr[inner-interval] >= insert)
			{
				arr[inner] = arr[inner-interval];
				inner -= interval;
				printf("\t\t* %d was moved.\n", arr[inner]);
			}
			arr[inner] = insert;
			printf("\t\t* %d was inserted at arr[%d].\n", insert, inner);
		}
		interval = (interval-1)/3;
		i++;
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
	printf("\t\tTitle: Shell Sort");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}