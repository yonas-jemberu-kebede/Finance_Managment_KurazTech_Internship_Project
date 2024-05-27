<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>

        <thead>
            <tr>
               <td>name</td>
               <td>email</td>
               <td>company_name</td>
               <td>country</td>
               <td>city</td>
               <td>address</td>
               <td> note</td>
               <td>action</td>
               
            </tr>
        
        </thead>
        
        <tbody>
           
            @foreach ($customers as $customer)

            <tr>
                <td>{{$customer->name}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->company_name}}/td>
                <td>{{$customer->country}}</td>
                <td>{{$customer->city}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->note}} </td>
                <div>
                    <button>Edit</button>
                    <button>Delete</button>
                </div>
            </tr>


                
            @endforeach

        </tbody>
    </table>
</body>
</html>