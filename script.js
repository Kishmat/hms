function delete_student(roll)
{
    if(confirm("Are you sure you want to delete this student?"))
    {
        location.href = `delete/student.php?roll=${roll}`;
    }
}
function delete_complain(id){
    if(confirm("Are you sure you want to delete this complain?")){
        location.href = `delete/complain.php?id=${id}`;
    }
}
function edit_student(roll)
{
    location.href = `edit.php?roll=${roll}`;
}
function logout()
{
    if(confirm("Are you sure you want to logout?")){
        location.href = 'logout.php';
    }
}
function preview_photo(input)
{
    let file = input.files[0];
    let image = document.getElementById("preview");
    if(file.type == "image/png" || file.type == "image/jpeg")
    {
        let src = URL.createObjectURL(file);
        image.src = src;
        image.style.display = "block";
    }else{
        alert("Invalid file format! Only PNG or JPEG is allowed!");
        location.reload();
    }
}
