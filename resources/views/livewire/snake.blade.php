<div style="font-family: sans-serif; text-align: center; padding: 20px;">
    <p>X: {{ $xPosition }}px</p>
    <p>Y: {{ $yPosition }}px</p>


    <div
        style="position: absolute; top: 40%; left: calc(50% + {{ $xPosition }}px);top: calc(40% + {{ $yPosition }}px ); width: 40px; height: 40px; background: {{ $actionBackgroundColor }}; border-radius: 8px; color:white;">
        {{ $action }}
    </div>



    @foreach ($buttons as $label => $button)
        <button
            wire:click="setCommonValues('{{ $button[0] }}', '{{ $button[1] }}', '{{ $button[2] }}', '{{ $button[3] }}' , '{{ $button[4] }}')" style="background: {{ $button[1] }};color:white;font-weight:bold;padding:6px;">{{ $label }}</button>
    @endforeach

</div>
