//const fields  = [$('#username'), $('#password'), $('#email')];

$('#submit').click(function(e, fields  = [$('#username'), $('#password'), $('#email')])
{
    for (const field of fields)
    {
        if (field.val() == "")
        {
            e.preventDefault();
            $('#' + $(field).attr('id') + '+ span').text('Veuillez renseigner ce champs');
        }
    }
});