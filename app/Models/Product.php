<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    // Define fillable attributes
    protected $fillable = ['name', 'brand','price','type','quantity','warranty'];

}
class Processor extends Model
{
    use HasFactory;

    protected $table = 'processor';

    // Define fillable attributes
    protected $fillable = ['processor_product_id','gen', 'core', 'socket'];
}

class Motherboard extends Model
{
    use HasFactory;

    protected $table = 'motherboard';

    // Define fillable attributes
    protected $fillable = ['motherboard_product_id','gen', 'processor', 'socket', 'ramtype'];
}
class Ram extends Model
{
    use HasFactory;

    protected $table = 'ram';

    // Define fillable attributes
    protected $fillable = ['ram_product_id','capacity', 'ramtype', 'speed'];
}
class Gpu extends Model
{
    use HasFactory;

    protected $table = 'gpu';

    // Define fillable attributes
    protected $fillable = ['gpu_product_id','chipset', 'memory'];
}
class ComputerCase extends Model //in table case but need to use ComputerCase due to php keyword
{
    use HasFactory;

    protected $table = 'case';

    // Define fillable attributes
    protected $fillable = ['case_product_id','color'];
}
class Storage extends Model
{
    use HasFactory;

    protected $table = 'storage';

    // Define fillable attributes
    protected $fillable = ['storage_product_id','interface', 'capacity'];
}
class Monitor extends Model
{
    use HasFactory;

    protected $table = 'monitor';

    // Define fillable attributes
    protected $fillable = ['monitor_product_id','size', 'panel', 'rate', 'resolution'];
}
class Accessories extends Model
{
    use HasFactory;

    protected $table = 'accessories';

    // Define fillable attributes
    protected $fillable = ['acce_product_id',];
}