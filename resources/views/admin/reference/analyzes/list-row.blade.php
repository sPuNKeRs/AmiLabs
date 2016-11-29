<tr id="analysis-{{ $analysis->id }}" data-iteration="{{ $iteration }}" data-analysis-id="{{ $analysis->id }}">
  <td>{{ $iteration }}</td>
  <td>{{ $analysis->name }}</td>
  <td>{{ $analysis->unit }}</td>
  <td>{{ $analysis->r_range }}</td>
  <td>
      <a href="#" data-analysis-id="{{ $analysis->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Редактировать" class="btn action-btn edit-analysis btn-warning waves-effect">
          <i class="material-icons">mode_edit</i>
      </a>

      <a href="#" data-analysis-id="{{ $analysis->id }}" data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="btn action-btn delete-analysis btn-danger waves-effect">
          <i class="material-icons">delete</i>
      </a>
  </td>
</tr>