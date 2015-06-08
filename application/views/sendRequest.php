<form action="/Project2ASL/ASLProject2/main/sendMail" method="POST">
<div class='row'>

      <div class='small-5 columns'>
        <label>Service Charge </label>
        <input name = 'paymentAmount' type="number" placeholder=" large-4.columns" value="<?=$paymentAmount?>" />
      </div>
      <div class='small-3 columns'>
        <label>Time In </label>
        <input name = 'timeIn'  type="text" placeholder=" large-4.columns" value="<?=$timeIn?>" />
      </div>
      <div class='small-3 columns'>
        <label>Time Out </label>
        <input name = 'timeOut' type="text" placeholder=" large-4.columns" value="<?=$timeOut?>" />
      </div>
    </div>
    <div class='small-6 small-offset-3 columns'>
      <label>Name </label>
      <input name = 'name'type="text" placeholder=" large-4.columns" value="<?=$name?>" />
    </div>
<div class="row">
   <div class="large-12 columns">
     <label>Message 
       <textarea name = 'messageContent' require="require" placeholder="small-11.columns"></textarea>
     </label>
   </div>
 </div>
<div class="row">
<input name = 'facebookID' type="hidden"  value="<?=$facebookID?>" />
<input type='submit'class="button small-8 small-offset-2 columns" value="Send Message"/>
</div>
</form>