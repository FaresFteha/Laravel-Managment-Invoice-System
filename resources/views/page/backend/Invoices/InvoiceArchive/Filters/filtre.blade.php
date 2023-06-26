<div class="card-body">
    <form action="{{ route('invoicesArchive.index') }}" method="get">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}" class="form-control" placeholder="ابحث هنا">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <select name="sort_by" class="form-control">
                    <option value="">---</option>
                    <option value="id" {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>الرقم</option>
                    <option value="invoice_number" {{ old('sort_by', request()->input('sort_by')) == 'invoice_number' ? 'selected' : '' }}>الاسم</option>
                    <option value="created_at" {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>وقت الانشاء</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <select name="order_by" class="form-control">
                    <option value="">---</option>
                    <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>تصاعديا</option>
                    <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>تنازليا</option>
                </select>
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                <select name="limit_by" class="form-control">
                    <option value="">---</option>
                    <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                    <option value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                    <option value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-1">
            <div class="form-group">
                <button type="submit"  class="btn btn-outline-primary me-1 mb-1">بحث</button>
            </div>
        </div>
    </div>
    </form>
</div>
