#include<stdio.h>
#include<stdlib.h>
#include<stdbool.h>

#define size 10

void header();
void footer();
void insert();
void removed();
void display();

int choice, item;
int rear = 0;
int front = 0;
int queue[size];

int main()
{
	header();
	printf("\n");

	bool exit = true;
	while(exit)
	{
		printf("\n\t\t\t~ Queue Menu ~");
		printf("\n\n\t\t1. Insert");
		printf("\n\t\t2. Remove");
		printf("\n\t\t3. Display");
		printf("\n\t\t4. Exit");
		printf("\n\n\t   | Enter your choice: ");
		scanf("%d", &choice);
		switch(choice)
		{
			case 1: 
				insert();
				break;
			case 2:
				removed();
				break;
			case 3:
				display();
				break;
			case 4:
				exit = false;
				break;
			default:
				printf("\n\t   | ERROR: Invalid keyword.\n");
		}
		if(exit==true)
			printf("\n       ==============================================\n");
		else
			footer();
	}
	printf("\n");
	return 0;
}

void insert()
{
	if(rear==size)
		printf("\n\t   | WARNING: Queue reached its maximum capacity.\n");
	else
	{
		printf("\t   | Enter a number to insert: ");
		scanf("%d", &item);
		printf("\t   | Position: %d, Inserted Value: %d\n", rear, item);
		queue[rear++] = item;
	}
}

void removed()
{
	if(front==rear)
		printf("\n\t   | WARNING: Queue is empty.\n");
	else
	{
		printf("\t   | Position: %d, Removed Value: %d\n", front, queue[front]);
		front++;
	}
}

void display()
{
	if(front==rear)
		printf("\n\t   | WARNING: Queue is empty.\n");
	else
	{
		printf("\t   | Queue Size: %d\n\t\t  ", rear);
		for(int i=front; i<rear; i++)
			printf("\n\t   | Position: %d, Value: %d", i, queue[i]);
		printf("\n");
	}
}

void header()
{
	printf("\n     ==================================================");
	printf("\n\t\tData Structures and Algorithm");
	printf("\n\tLesson: Stack & Queue");
	printf("\t   Title: Queue");
	printf("\n     --------------------------------------------------");
}

void footer()
{
	printf("\n     --------------------------------------------------");
	printf("\n\t\t    ~ Royland V. Pepaño ~");
	printf("\n\t\t   A 2nd Year BSIT student");
	printf("\n     ==================================================\n");
}