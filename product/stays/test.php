<?php require __DIR__ . '/../../parts/connect_db.php';?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>   
    <form name="form1" onsubmit="checkForm(); return false">
        <input type="file" name="img" id="img">
        <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
    </form>

    <script src="hotel.js"></script>

    <script>

        let submitbtn = document.getElementById('submitbtn')
        let img = document.getElementById('img')


        submitbtn.addEventListener('click',function(){
            console.log(this.name);
        })
        
        function checkForm() {
        let fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}:${fd.get(k)}`);
        }
        fetch('test-api.php', {
                method: 'POST',
                body: fd
            })
            // .then(r=>r.json()).then(obj=>{
            //      console.log(obj);
            //     if(! obj.success){
            //         alert(obj.error);
            //     }
            //  })
            .then(function(f) {
                return f.json()
            }).then(function(obj) {
                console.log(obj.success);
                if (!obj.success) {
                    alert(obj.error);
                } else {
                    alert('新增成功')
                }
            })
    }
    </script>
</body>

</html>
<?php include __DIR__ . '/../../parts/script.php';?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>