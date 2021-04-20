
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<script>
  let data = [
    {user: 'Eduardo', age: 30, role: 'CEO'},
    {user: 'Andrés', age: 34, role: 'Project Manager'},
    {user: 'Andrés', age: 34, role: 'Engeneer'},
    {user: 'Mariela', age: 31, role: 'SAC'}
];

console.log(data)
data.sort((a, b) => a.user - b.user)

console.log(data)

</script>          
</body>
