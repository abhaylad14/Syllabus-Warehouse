<?php
function displaymessage($type, $title, $message){
    echo "<script>Lobibox.notify('$type',{title: '$title',msg: '$message',sound: false,delay: '2000',icon: true, iconSource: 'fontAwesome'});</script>";
}

?>
<script>
function displaymessage(mtype,mtitle,message){
    Lobibox.notify(mtype,{title: mtitle,msg: message,sound: false,delay: '2000',icon: true, iconSource: 'fontAwesome'});
}
</script>