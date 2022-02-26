# unit-calculator-for-su-inf

Calculate your unit.

Made for Informatics Faculty of Shizuoka Univ.

The usage of this application is at the user's own risk.
We will not be responsible for any damage or liability caused by this application.

# JSON structure

In this application, JSON file is used to manage information.

## Faculty and department information

```json
{
    "code": String,
    "name": String,
    "isEnabled": Integer
}
```

"code" and "name" refers to the following table.

|code|name|
|----|----|
|if|情報学部|
|cs|情報科学科|
|bi|行動情報学科|
|ia|情報社会学科|

Code "if" is not used but is defined.

To disable specific department from being target of calculation, set "isDisabled" to 1, otherwise 0 must be set as default.

## Unit information

```json
{
    "name": String,
    "unit": Integer,
    "type": String,
    "dept": Integer
}
```

### Unit

In "unit", insert the number of unit that is specified for the subject.

### Type

In "type", enter the type of that subject. Available type is showed in the following list.

|type|name|
|----|----|
|facRequired|Required unit in common faculty subjects|
|facSelect|Selective unit in common faculty subjects|
|deptRequired|Required unit in department subjects|
|deptRequired[A~D]|Required unit in department subjects (only used for Department of Behvioral Informatics)
|deptSelect|Selective unit in department subjects|

### Dept

In "dept", insert the number that matches in the following table.

|no.|Department Name|
|---|---------------|
|0  |Faculty of Informatics|
|1  |Department of Computer Science|
|2  |Department of Behavioral Informatics|
|3  |Department of Information Arts|

## Unit requirement information for each department

To define unit requirement specified for each department, following JSON structure is used.

```json
{
    "dept": Integer,
    "deptRequired": Integer,
    "deptSelectRequired": {
      "A": Integer
    },
    "deptSelect": Integer
}
```
