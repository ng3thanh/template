<div>
    Hello Ms.Phuong,
    <br><br>
    You received 1 feedback from <i>{{ $data['name'] }}</i>.
    <br><br>
    <b> Sender info: </b><br>
    Phone: {{ $data['phone'] or 'No phone' }} ,<br>
    Email: {{ $data['mail'] or 'No mail' }} ,
    <br>
    <br>
    <b>{{ $data['subject'] }}</b>
    <p>{{ $data['content'] }}</p>

    Thank you,
    <br/>
    <i>IBLC Firm</i>
</div>