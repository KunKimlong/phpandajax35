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
        <h1 class="text-center">Emplyee Management</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    <label for="">Name:</label>
                    <input type="text" name="name" placeholder="Name" id="name" class="form-control my-2">
                    <label for="">Gender:</label>
                    <select name="gender" id="gender" class="form-select my-2">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="">Salary:</label>
                    <input type="text" name="salary" placeholder="Salary" id="salary" class="form-control my-2">
                    <label for="">Profile</label>
                    <input type="file" name="profile" id="choose_profile" class="form-control my-2">
                    <img src="Image/nonProfile.jpg" id="profile_image" width="100px" alt="">
                    <div class="mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
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
                }
            });
        })
    });
</script>
</html>