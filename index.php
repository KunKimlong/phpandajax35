<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <style>
    img{
        cursor: pointer;
    }
  </style>
</head>
<body>
    <div class="container-fluid p-4 bg-dark">
        <h1 class="text-center text-light">Emplyee Management</h1>
        <!-- Button trigger modal -->
        <button type="button"id="btn-open-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Add Employee
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="" id="txt_id">
                    <label for="">Name:</label>
                    <input type="text" name="" placeholder="Name" id="name" class="form-control my-2">
                    <label for="">Gender:</label>
                    <select name="" id="gender" class="form-select my-2">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="">Salary:</label>
                    <input type="text" name="" placeholder="Salary" id="salary" class="form-control my-2">
                    <label for="">Profile</label>
                    <input type="file" name="profile" id="choose_profile" class="form-control my-2">
                    <img src="Image/nonProfile.jpg" id="profile_image" width="100px" alt="">
                    <input type="text" name="" id="profileValue">
                    <div class="mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btn-submit" data-bs-dismiss="modal" class="btn btn-success">Submit</button>
                        <button type="button" id="btn-update" data-bs-dismiss="modal" class="btn btn-warning">Update</button>
                        <button type="reset" class="btn btn-danger" id="btn-reset">Reset</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="col-8 mx-auto">
            <table class="table table-dark table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Salary</th>
                        <th>Profile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $connection = new mysqli('localhost','root','','db-php-3-5');
                        $rs = $connection->query('SELECT * FROM `tbl_ajax`');
                        while($row = mysqli_fetch_assoc($rs)){
                            echo  '
                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['gender'].'</td>
                                <td>'.$row['salary'].'</td>
                                <td><img src="Image/'.$row['profile'].'" alt="'.$row['profile'].'" width="80px"></td>
                                <td>
                                    <button id="btn-open-update" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning">Update</button>
                                    <button remove_id = "'.$row['id'].'" id="btn-delete" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            
                            ';
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    $(document).ready(function(){
        $('#profile_image').click(function(){
            $('#choose_profile').click();
        });
        $('#choose_profile').change(function(){
            var formData = new FormData();
            var profile = $("#choose_profile")[0].files[0];
            // append by name
            formData.append('profile',profile);

            $.ajax({
                url:'move.php',
                method:'post',
                data:formData,
                contentType:false,
                cache:false,
                processData:false,
                success:function(respone){
                    $('#profile_image').attr('src','Image/'+respone); 
                    $('#profileValue').val(respone);  
                }
            });
        })
        $('#btn-submit').click(function(){
            // alert(123);
            var Name = $('#name').val();
            var gender = $('#gender').val();
            var salary = $('#salary').val();
            var profile = $('#profileValue').val();

            $.ajax({
                url:'insert.php',
                data:{
                    insert_name:Name,
                    insert_gender:gender,
                    insert_salary:salary,
                    insert_profile:profile,
                },
                method:'POST',
                cache:false,
                success:function(respone){
                    if(respone){
                        var txt = `
                            <tr>
                                <td>${respone}</td>
                                <td>${Name}</td>
                                <td>${gender}</td>
                                <td>${salary}</td>
                                <td>
                                    <img src="Image/${profile}" alt="${profile}" width="80px">
                                </td>
                                <td>
                                    <button id="btn-open-update" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning">Update</button>
                                    <button remove_id="${respone}" id="btn-delete" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('tbody').append(txt);
                        $('#profile_imageS').attr('src','Image/nonProfile.jpg')
                        $('#btn-reset').click();
                    }
                }
            });
        });

        $('#btn-open-add').click(function(){
            $('#btn-submit').show();
            $('#btn-update').hide();
        })
        var index = '';

        $('body').on('click','#btn-open-update',function(){

            $('#btn-submit').hide();
            $('#btn-update').show();

            index = $(this).parents('tr').index();
            // alert(index)
            var id = $(this).parents('tr').find('td').eq(0).text();
            var Name = $(this).parents('tr').find('td').eq(1).text();
            var gender = $(this).parents('tr').find('td').eq(2).text();
            var salary = $(this).parents('tr').find('td').eq(3).text();
            var profile = $(this).parents('tr').find('td').eq(4).find('img').attr('alt');
            
            $('#txt_id').val(id);
            $('#name').val(Name);
            $('#gender').val(gender);
            $('#salary').val(salary);
            $('#profileValue').val(profile);
            $('#profile_image').attr('src','Image/'+profile);

        })
        $('#btn-update').click(function(){
            var id  = $('#txt_id').val();
            var Name = $('#name').val();
            var gender = $('#gender').val();
            var salary = $('#salary').val();
            var profile = $('#profileValue').val();

            $.ajax({
                url:'update.php',
                method:'POST',
                data:{
                    update_id:id,
                    update_name:Name,
                    update_gender:gender,
                    update_salary:salary,
                    update_profile:profile,
                },
                cache:false,
                success:function(respone){
                    if(respone){
                        var txt = `
                            <td>${id}</td>
                            <td>${Name}</td>
                            <td>${gender}</td>
                            <td>${salary}</td>
                            <td>
                                <img src="Image/${profile}" alt="${profile}" width="80px">
                            </td>
                            <td>
                                <button id="btn-open-update" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning">Update</button>
                                <button remove_id="${respone}" id="btn-delete" class="btn btn-danger">Delete</button>
                            </td>
                        `;
                        $('table').find('tbody').find('tr').eq(index).html(txt);
                    }
                }
            });

        });

        $('body').on('click','#btn-delete',function(){
            var idx = $(this).parents('tr').index();
            var remove_id = $(this).attr('remove_id');

            $.ajax({
                url:'remove.php',
                method:'post',
                data:{
                    // remove_id:remove_id,
                    remove_id,
                },
                cache:false,
                success:function(respone){
                    if(respone){
                        $('table').find('tbody').find('tr').eq(idx).remove();
                    }
                }

            });

        });
    });
</script>
</html>