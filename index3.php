<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body style="color: white; background-color: #1d2630">
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-5 mb-5">CRUD APPLICATION</h1>
        </div>
        <div class="main row justify-content-center">
            <form action="" id="student-form" class="row justify-content-center mb-4" autocomplete="off">
                <div class="col-10 col-md-12 mb-3">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                </div>
                <div class="col-10 col-md-12 mb-3">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                </div>
                <div class="col-10 col-md-12 mb-3">
                    <label for="rollno">Roll Number</label>
                    <input type="text" name="rollno" id="rollno" class="form-control" placeholder="Enter Roll Number">
                </div>
                <div class="col-12">
                    <input type="submit" value="submit" class="btn btn-success add-btn">
                </div>
            </form>

            <div class="col-10 mt-5">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Roll Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="student-list">
                        <tr>
                            <td>Dear</td>
                            <td>Programmer</td>
                            <td>25</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm edit">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm delete">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
    var selectedRow = null;

    function showAlert(message, className){
        const div = document.createElement("div");
        div.className = 'alert alert-' + className;

        div.appendChild(document.createTextNode(message));
        const container = document.querySelector(".container");
        const main= document.querySelector(".main");
        container.insertBefore(div, main);

        setTimeout(() => document.querySelector(".alert").remove(), 3000);
    }

    function clearFields(){
        document.querySelector("#firstname").value = "";
        document.querySelector("#lastname").value = "";
        document.querySelector("#rollno").value = "";
    }

    document.querySelector("#student-form").addEventListener("submit", (e) =>{
        e.preventDefault();
 
        const firstname = document.querySelector("#firstname").value;
        const lastname = document.querySelector("#lastname").value;
        const rollno = document.querySelector("#rollno").value;

        if(firstname == "" || lastname == "" || rollno == ""){
            showAlert("Please fill in all fields", "danger");
        } else {
            if(selectedRow == null){
                const list = document.querySelector("#student-list");
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${firstname}</td>
                    <td>${lastname}</td>
                    <td>${rollno}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm edit">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm delete">Delete</a>
                    </td>`;
                list.appendChild(row);
                selectedRow = null;
                showAlert("Student Added", "success");            
            } else {
                selectedRow.children[0].textContent = firstname;
                selectedRow.children[1].textContent = lastname;
                selectedRow.children[2].textContent = rollno;
                selectedRow = null;
                showAlert("Student Info Edited", "info");
            }

            clearFields();
        }
    });

    document.querySelector("#student-list").addEventListener("click", (e) =>{
        const target = e.target;
        if(target.classList.contains("edit")){
            selectedRow = target.parentElement.parentElement;
            document.querySelector("#firstname").value = selectedRow.children[0].textContent;
            document.querySelector("#lastname").value = selectedRow.children[1].textContent;
            document.querySelector("#rollno").value = selectedRow.children[2].textContent;
        }
        if(target.classList.contains("delete")){
            target.parentElement.parentElement.remove();
            showAlert("Student Data Deleted", "danger");
        }
    });
</script>
</body>
</html>
