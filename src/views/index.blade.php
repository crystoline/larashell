<html>
<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" />
    <style>
        iframe {
            height: 300px;
            width: 600px;
            resize: both;
            overflow: auto;
            background-color: black;
            color: white;
        }
    </style>
</head>
<script>
    <!--//
    function inst_cmd(obj){
        var dest = $('#cmd');
        var caretPos = dest[0].selectionStart;
        var textAreaTxt = dest.val();
        var txtToAdd = $(obj).attr('cmd');
        dest.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );

        /*var cmd = $(obj).attr('cmd');
        dest.val(dest.val()+ " " + cmd)*/
    }
    //-->
</script>
<body>
<div class="ui container">
    <h3>CMD Tool</h3>
    <iframe name="output" style=""></iframe>

@php
    $php_cmd = ' env PATH="/opt/php70/bin:$PATH" php';
@endphp
    <form id="cons" method="post" action="" target="output" style="max-width: 600px">
        {{ csrf_field() }}
        <fieldset>
            <legend>Run Commands</legend>
            <div class="ui icon buttons">
                <button class="ui mini button" type="button" onclick="inst_cmd(this)" cmd='cd'>CD</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd='{{$php_cmd}}'>PHP7</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="dir">DIR</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="ls -al">LS</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="git pull origin production">GIT</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="mkdir">MKDIR</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="rm">RM</button>
                <button class="ui mini button"  type="button" onclick="inst_cmd(this)" cmd="\n"><i class="ui icon level down alternate"></i></button>
            </div>
            <br>
            <label class="" for="cmd">Command</label><br>
            <div class="ui input">
                <textarea id="cmd"  name="cmd" cols="71" rows="6">{{ old('cmd') }}</textarea>
            </div>
            <div>
                <b>Type</b>: <label><input type="radio" name="type" value="artisan" checked>Artisan</label>
                <label><input type="radio" name="type" value="shell">Shell</label>
            </div>
            <label>Parameters</label><br>
            <div class="ui input">
                <input  name="param[]" value="" size="7"><input name="paramValue[]" value="" size="7">&nbsp;
            </div>
            <div class="ui input">
                <input name="param[]" value="" size="7"><input name="paramValue[]" value="" size="7">&nbsp;
            </div>
            <div class="ui input">
                <input  name="param[]" value="" size="7"><input name="paramValue[]" value="" size="7">
            </div>
        </fieldset>
        <button class="ui primary button" type="submit">Execute</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
</body>
</html>