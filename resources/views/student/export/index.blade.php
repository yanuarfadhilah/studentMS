<tr>
    <td> </td>
    <td>
        <select>
            @foreach($levels as $level)
                <option value="{{ $level }}">{{ $level }}</option>
            @endforeach
        </select>
     </td>
     <td>
        <select>
            @foreach($classDatas as $classData)
                <option value="{{ $classData->id }}">{{ $classData->name }}</option>
            @endforeach
        </select>
     </td>
     <td> </td>
</tr>
