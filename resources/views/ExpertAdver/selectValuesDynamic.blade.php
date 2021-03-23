<option {!! ( $attribute['status'] == 'positive' ? 'selected' : '') !!} value="positive">سالم </option>
<option {!! ( $attribute['status'] == 'negative' ? 'selected' : '') !!} value="negative">معیوب</option>
<option {!! ( $attribute['status'] == 'undocumented' ? 'selected' : '') !!} value="undocumented">کارشناسی نشده</option>
<option {!! ( $attribute['status'] == 'swap' ? 'selected' : '') !!} value="swap">تعویضی</option>
<option {!! ( $attribute['status'] == 'have' ? 'selected' : '') !!} value="have">دارد</option>
<option {!! ( $attribute['status'] == 'nothave' ? 'selected' : '') !!} value="nothave">ندارد</option>
<option {!! ( $attribute['status'] == 'voided' ? 'selected' : '') !!} value="voided">باطل شده</option>