<!--
*******************************************
*                                         *
* Application: Back-end of CDL_Services  *
*                                         *
* Author: Alejandro Pena Canelon          *
*         Daniel Tran                     *
*         David Do                        *
*         Jimmy Lam                       *
*         Jordan Banh                     *
*         Justin Serrano                  *
*                                         *
* Date: April 16, 2021                    *
*                                         *
******************************************* -->
<h1>Invoice for your CDL Services completed job</h1>

Invoice Number: {{$invoice_num}} <br>
Billed To: {{$bill_to}} <br>
Service Offered: {{$service_offered}} <br>
Date Issued: {{$issue_date}} <br>
Due Date: {{$due_date}} <br>
Cost of Service: ${{$service_cost}}
