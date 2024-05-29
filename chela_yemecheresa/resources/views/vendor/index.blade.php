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
           
            @foreach ($vendors as $vendor)

            <tr>
                <td>{{$vendor->name}}</td>
                <td>{{$vendor->email}}</td>
                <td>{{$vendor->company_name}}/td>
                <td>{{$vendor->country}}</td>
                <td>{{$vendor->city}}</td>
                <td>{{$vendor->address}}</td>
                <td>{{$vendor->note}} </td>
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