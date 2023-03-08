<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'El campo <b>:attribute</b> debe ser aceptado.',
    'active_url'           => 'El campo <b>:attribute</b> no es una URL válida.',
    'after'                => 'El campo <b>:attribute</b> debe ser una fecha posterior a <b>:date</b>.',
    'after_or_equal'       => 'El campo <b>:attribute</b> debe ser una fecha posterior o igual a <b>:date</b>.',
    'alpha'                => 'El campo <b>:attribute</b> sólo debe contener letras.',
    'alpha_dash'           => 'El campo <b>:attribute</b> sólo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El campo <b>:attribute</b> sólo debe contener letras y números.',
    'array'                => 'El campo <b>:attribute</b> debe ser un conjunto.',
    'attached'             => 'Este :attribute ya se adjuntó.',
    'before'               => 'El campo <b>:attribute</b> debe ser una fecha anterior a <b>:date</b>.',
    'before_or_equal'      => 'El campo <b>:attribute</b> debe ser una fecha anterior o igual a <b>:date</b>.',
    'between'              => [
        'array'   => 'El campo <b>:attribute</b> tiene que tener entre :min - :max elementos.',
        'file'    => 'El campo <b>:attribute</b> debe pesar entre :min - :max kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> tiene que estar entre :min - :max.',
        'string'  => 'El campo <b>:attribute</b> tiene que tener entre :min - :max caracteres.',
    ],
    'boolean'              => 'El campo <b>:attribute</b> debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'El campo <b>:attribute</b> no es una fecha válida.',
    'date_equals'          => 'El campo <b>:attribute</b> debe ser una fecha igual a <b>:date</b>.',
    'date_format'          => 'El campo <b>:attribute</b> no corresponde al formato :format.',
    'different'            => 'El campo <b>:attribute</b> y :other deben ser diferentes.',
    'digits'               => 'El campo <b>:attribute</b> debe tener :digits dígitos.',
    'digits_between'       => 'El campo <b>:attribute</b> debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen :attribute no son válidas.',
    'distinct'             => 'El campo <b>:attribute</b> contiene un valor duplicado.',
    'email'                => 'El campo <b>:attribute</b> no es un correo válido.',
    'ends_with'            => 'El campo <b>:attribute</b> debe finalizar con uno de los siguientes valores: :values',
    'exists'               => 'El campo <b>:attribute</b> es inválido.',
    'file'                 => 'El campo <b>:attribute</b> debe ser un archivo.',
    'filled'               => 'El campo <b>:attribute</b> es obligatorio.',
    'gt'                   => [
        'array'   => 'El campo <b>:attribute</b> debe tener más de :value elementos.',
        'file'    => 'El campo <b>:attribute</b> debe tener más de :value kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> debe ser mayor que :value.',
        'string'  => 'El campo <b>:attribute</b> debe tener más de :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'El campo <b>:attribute</b> debe tener como mínimo :value elementos.',
        'file'    => 'El campo <b>:attribute</b> debe tener como mínimo :value kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> debe ser como mínimo :value.',
        'string'  => 'El campo <b>:attribute</b> debe tener como mínimo :value caracteres.',
    ],
    'image'                => 'El campo <b>:attribute</b> debe ser una imagen.',
    'in'                   => 'El campo <b>:attribute</b> es inválido.',
    'in_array'             => 'El campo <b>:attribute</b> no existe en :other.',
    'integer'              => 'El campo <b>:attribute</b> debe ser un número entero.',
    'ip'                   => 'El campo <b>:attribute</b> debe ser una dirección IP válida.',
    'ipv4'                 => 'El campo <b>:attribute</b> debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El campo <b>:attribute</b> debe ser una dirección IPv6 válida.',
    'json'                 => 'El campo <b>:attribute</b> debe ser una cadena JSON válida.',
    'lt'                   => [
        'array'   => 'El campo <b>:attribute</b> debe tener menos de :value elementos.',
        'file'    => 'El campo <b>:attribute</b> debe tener menos de :value kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> debe ser menor que :value.',
        'string'  => 'El campo <b>:attribute</b> debe tener menos de :value caracteres.',
    ],
    'lte'                  => [
        'array'   => 'El campo <b>:attribute</b> debe tener como máximo :value elementos.',
        'file'    => 'El campo <b>:attribute</b> debe tener como máximo :value kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> debe ser como máximo :value.',
        'string'  => 'El campo <b>:attribute</b> debe tener como máximo :value caracteres.',
    ],
    'max'                  => [
        'array'   => 'El campo <b>:attribute</b> no debe tener más de :max elementos.',
        'file'    => 'El campo <b>:attribute</b> no debe ser mayor que :max kilobytes.',
        'numeric' => 'El campo <b>:attribute</b> no debe ser mayor que :max.',
        'string'  => 'El campo <b>:attribute</b> no debe ser mayor que :max caracteres.',
    ],
    'mimes'                => 'El campo <b>:attribute</b> debe ser un archivo con formato: :values.',
    'mimetypes'            => 'El campo <b>:attribute</b> debe ser un archivo con formato: :values.',
    'min'                  => [
        'array'   => 'El campo <b>:attribute</b> debe tener al menos :min elementos.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'string'  => 'El campo <b>:attribute</b> debe contener al menos :min caracteres.',
    ],
    'multiple_of'          => 'El campo <b>:attribute</b> debe ser múltiplo de :value',
    'not_in'               => 'El campo <b>:attribute</b> es inválido.',
    'not_regex'            => 'El formato del campo <b>:attribute</b> no es válido.',
    'numeric'              => 'El campo <b>:attribute</b> debe ser numérico.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo <b>:attribute</b> debe estar presente.',
    'prohibited'           => 'El campo <b>:attribute</b> está prohibido.',
    'prohibited_if'        => 'El campo <b>:attribute</b> está prohibido cuando :other es :value.',
    'prohibited_unless'    => 'El campo <b>:attribute</b> está prohibido a menos que :other sea :values.',
    'regex'                => 'El formato de :attribute es inválido.',
    'relatable'            => 'Este :attribute no se puede asociar con este recurso',
    'required'             => 'El campo <b>:attribute</b> es obligatorio.',
    'required_if'          => 'El campo <b>:attribute</b> es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo <b>:attribute</b> es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo <b>:attribute</b> es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo <b>:attribute</b> es obligatorio cuando :values están presentes.',
    'required_without'     => 'El campo <b>:attribute</b> es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo <b>:attribute</b> es obligatorio cuando ninguno de :values está presente.',
    'same'                 => 'El campo <b>:attribute</b> y :other deben coincidir.',
    'size'                 => [
        'array'   => 'El campo <b>:attribute</b> debe contener :size elementos.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'string'  => 'El campo <b>:attribute</b> debe contener :size caracteres.',
    ],
    'starts_with'          => 'El campo <b>:attribute</b> debe comenzar con uno de los siguientes valores: :values',
    'string'               => 'El campo <b>:attribute</b> debe ser una cadena de caracteres.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => 'El campo <b>:attribute</b> ya ha sido registrado.',
    'uploaded'             => 'Subir :attribute ha fallado.',
    'url'                  => 'El formato :attribute es inválido.',
    'uuid'                 => 'El campo <b>:attribute</b> debe ser un UUID válido.',
    'custom'               => [
        'email'    => [
            'unique' => 'El :attribute ya ha sido registrado.',
        ],
        'password' => [
            'min' => 'La :attribute debe contener más de :min caracteres',
        ],
    ],
    'attributes'           => [
        'address'               => 'dirección',
        'age'                   => 'edad',
        'body'                  => 'contenido',
        'city'                  => 'ciudad',
        'content'               => 'contenido',
        'country'               => 'país',
        'current_password'      => 'contraseña actual',
        'date'                  => 'fecha',
        'day'                   => 'día',
        'description'           => 'descripción',
        'email'                 => 'correo electrónico',
        'excerpt'               => 'extracto',
        'first_name'            => 'nombre',
        'gender'                => 'género',
        'hour'                  => 'hora',
        'last_name'             => 'apellido',
        'message'               => 'mensaje',
        'minute'                => 'minuto',
        'mobile'                => 'móvil',
        'month'                 => 'mes',
        'name'                  => 'nombre',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'phone'                 => 'teléfono',
        'price'                 => 'precio',
        'role'                  => 'rol',
        'second'                => 'segundo',
        'sex'                   => 'sexo',
        'subject'               => 'asunto',
        'terms'                 => 'términos',
        'time'                  => 'hora',
        'title'                 => 'título',
        'username'              => 'usuario',
        'year'                  => 'año',

        'repeat_password'       => 'repetir contraseña',

        /** Custom Attributes */

        'role_id' => 'rol',
        'slug' => 'abreviatura',

        'code' => 'código',

        'intellectual_property_right_category_id' =>  'categoría de los derechos de propiedad intelectual',
        'intellectual_property_right_subcategory_id' =>  'subcategoría de los derechos de propiedad intelectual',
        'intellectual_property_right_product_id' =>  'producto de los derechos de propiedad intelectual',

        'country_id' => 'país',
        'state_id' => 'departamento',

        'permission_module_id' => 'categoria del permiso',

        'administrative_unit_id' => 'facultad',
        'academic_department_id' => 'departamento académico',
        'research_unit_id' => 'unidad investigativa ',
        'project_id' => 'proyecto',
        'research_unit_category_id' => 'unidad de investigación',
        'director_id' => 'director',
        'inventory_manager_id' => 'administrador de inventario',

        'localization_code' => 'código de localización',

        'document' => 'documento',
        'document_type_id' => 'tipo de documento',
        'expedition_place_id' => 'lugar de expedición',

        'linkage_type_id' => 'tipo de vinculación',
        'assignment_contract_id' => 'tipo de contratación',

        'financing_type_id' => 'tipo de financión',
        'project_contract_type_id' => 'tipo de contrato',

        /** Assignment Contracts */
        'is_internal' => 'es interno o externo',

        'published_in' => 'medio de publicación',
        'published_at' => 'fecha de publicación',

    ],
];
