<html>
  <head>
    <style>
      body { font-family: DejaVu Sans; font-size: 12px; }
      .table { width: 100%; margin-bottom: 1rem; color: #212529; background-color: transparent; }
      table { border-collapse: collapse; }
      .table td, .table th { padding: 0.75rem; vertical-align: top; border-top: 1px solid #dee2e6; }
      .table thead th { border-bottom: 2px solid #dee2e6; }
    </style>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <div class="row">
        <div class="col-12 col-md-12 order-2 order-md-1">
            <div class="row">
            <div class="col-12">
                <h3>Заказчик "{{ $entity->first_name . ' ' . $entity->last_name }}"</h3>
                <p style="margin-top: 10px;">
                <strong>Имя:</strong> {{ $entity->first_name }}<br>
                <strong>Фамилия:</strong> {{ $entity->last_name }}<br>
                <strong>Email:</strong> {{ $entity->email }}<br>
                <strong>Телефон:</strong> {{ $entity->phone }}<br>
                <strong>Дополнительный тел:</strong> {{ ($entity->dop_phone) ? $entity->dop_phone : '-' }}<br>
                <strong>Адрес доставки:</strong> {{ $entity->address }}<br>
                <strong>Комментарий:</strong> {{ $entity->comment }}<br>
                </p>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row" style="padding:10px;">
        <div class="col-12 table-responsive">
        <h3>Заказы поставщика</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>№ заказа</th>
                <th>Кол-во пар</th>
                <th>Комментарий</th>
                <th>Скидка</th>
                <th>Итоговая цена</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
              <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>