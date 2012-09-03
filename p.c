#include<stdio.h>
int main()
{
int i ,j, a=1;
int sum=0;
int b=2;
for (i=1; i<=500; i++)
{
 for ( j=1; j<=4; j++)
{
a=a+b;
sum=sum+ a;
}
b=b+2;
}

sum =sum +1;
//sum = sum /2;

printf("sum=%d\n",sum);
}

