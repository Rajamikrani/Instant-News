#include<stdio.h>
#include<conio.h>
#include<math.h>

void main()
{
    int n, headposition, i, j, k, seek=0, maxrange=199, difference, temp, temp1=0, temp2=0;
    float averageSeekTime;
    printf("Enter the number of queue requests: ");
    scanf("%d", &n);
    printf("Enter the initial head position: ");
    scanf("%d", &headposition);
    printf("Enter the disk positions of the requests (queue): ");
    for(i=0; i<n; i++)
    {
        scanf("%d", &temp);
        if(temp >= headposition)
        {
            queue1[temp1] = temp;
            temp1++;
        }
        else
        {
            queue2[temp2] = temp;
            temp2++;
        }
    }
    for (i = 0; i < temp1; i++) {
         for (j = i + 1; j < temp1; j++) {
             if (queue1[i] > queue1[j]) {
                 temp = queue1[i];
                  queue1[i] = queue1[j];
                   queue1[j] = temp;
                 } 
             } 
          }
    for (i = 0; i < temp2-1; i++) {
         for (j = i + 1; j < temp2; j++) {
             if (queue2[i] > queue2[j]) {
                 temp = queue2[i];
                  queue2[i] = queue2[j];
                   queue2[j] = temp;
           } 
        } 
    }      
for (i = 0, j = 0; i < temp2; i++, j++) {
     queue[i] = queue[j]; 
     queue[i] = maxrange;
     queue[i+1] = 0;
}
for (i = temp1 + 3, j = 0; j < temp2; i++, j++) { 
    queue[i] = queue2[j];
     printf("%d", queue[i]);
 }
 queue[0] = headposition;
 printf("%d -->" , queue[0]);
 for ( j = 0; j < n+2; j++)
 {
   { difference = abs(queue[j+1] - queue[j]);
    seek += difference; 
    printf(" %d --> ", queue[j+1]);
 }
}
 averageSeekTime = seek/(float)n;
 printf("\n Total seek Time = %d \n" , seek );
  printf("\n Average Seek  Time = %f \n" , averageSeekTime );
    getch();

}





















































