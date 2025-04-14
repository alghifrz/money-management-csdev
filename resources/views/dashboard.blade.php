@extends('layouts.app', ['username' => $profile->username ?? null])

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary-gradient">
                <div class="card-body summary-card">
                    <i class="fas fa-wallet"></i>
                    <h6>Total Saldo</h6>
                    <h4 class="animate-number" data-format="Rp #">Rp {{ number_format($totalBalance, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success-gradient">
                <div class="card-body summary-card">
                    <i class="fas fa-arrow-up"></i>
                    <h6>Total Pemasukan</h6>
                    <h4 class="animate-number" data-format="Rp #">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-danger-gradient">
                <div class="card-body summary-card">
                    <i class="fas fa-arrow-down"></i>
                    <h6>Total Pengeluaran</h6>
                    <h4 class="animate-number" data-format="Rp #">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Dompet</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addWalletModal">
                        <i class="fas fa-plus me-1"></i> Tambah Dompet
                    </button>
                </div>
                <div class="card-body">
                    @if($wallets->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-wallet fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada dompet. Silakan tambahkan dompet baru.</p>
                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addWalletModal">
                                <i class="fas fa-plus me-1"></i> Tambah Dompet Pertama
                            </button>
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($wallets as $wallet)
                                <div class="list-group-item list-group-item-action wallet-item" style="border-left-color: {{ $wallet->color ?? '#6c757d' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h6 class="mb-1 fw-bold">{{ $wallet->name }}</h6>
                                        <div class="dropdown">
                                            <button class="btn btn-sm text-muted" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editWalletModal{{ $wallet->id }}">
                                                        <i class="fas fa-edit me-2"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('wallets.destroy', $wallet->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus dompet ini?')">
                                                            <i class="fas fa-trash me-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="badge bg-light text-dark me-2">{{ $wallet->type }}</span>
                                    </div>
                                    <p class="mb-1 mt-3 fw-bold fs-5">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</p>
                                    @if($wallet->description)
                                        <small class="text-muted d-block mt-2">{{ $wallet->description }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Transaksi</h5>
                    <div>
                        <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
                            <i class="fas fa-plus me-1"></i> Pemasukan
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                            <i class="fas fa-minus me-1"></i> Pengeluaran
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($transactions->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-exchange-alt fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada transaksi. Silakan tambahkan transaksi baru.</p>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
                                    <i class="fas fa-plus me-1"></i> Tambah Pemasukan
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                                    <i class="fas fa-minus me-1"></i> Tambah Pengeluaran
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Dompet</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="d-inline-block" style="border-left: 3px solid {{ $transaction->wallet->color ?? '#6c757d' }}; padding-left: 8px;">
                                                    {{ $transaction->wallet->name }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($transaction->category)
                                                    <span class="badge bg-light text-dark">{{ $transaction->category }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="{{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }} fw-bold">
                                                {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </td>
                                            <td>{{ Str::limit($transaction->description, 30) ?? '-' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editTransactionModal{{ $transaction->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Wallet Modal -->
<div class="modal fade" id="addWalletModal" tabindex="-1" aria-labelledby="addWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('wallets.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addWalletModalLabel">Tambah Dompet Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Dompet</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="cash">Uang Tunai</option>
                            <option value="bank">Rekening Bank</option>
                            <option value="e-wallet">E-Wallet</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="balance" class="form-label">Saldo Awal</label>
                        <input type="number" class="form-control" id="balance" name="balance" min="0" step="0.01" value="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Warna</label>
                        <input type="color" class="form-control form-control-color w-100" id="color" name="color" value="#3279d0">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Income Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1" aria-labelledby="addIncomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="income">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIncomeModalLabel">
                        <i class="fas fa-arrow-up text-success me-2"></i>Tambah Pemasukan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="wallet_id" class="form-label">Dompet</label>
                        <select class="form-select" id="wallet_id" name="wallet_id" required>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category" list="income-categories">
                        <datalist id="income-categories">
                            <option value="Gaji">
                            <option value="Bonus">
                            <option value="Hadiah">
                            <option value="Investasi">
                            <option value="Penjualan">
                            <option value="Lainnya">
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="expense">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseModalLabel">
                        <i class="fas fa-arrow-down text-danger me-2"></i>Tambah Pengeluaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="wallet_id" class="form-label">Dompet</label>
                        <select class="form-select" id="wallet_id" name="wallet_id" required>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category" list="expense-categories">
                        <datalist id="expense-categories">
                            <option value="Makanan">
                            <option value="Transportasi">
                            <option value="Belanja">
                            <option value="Hiburan">
                            <option value="Tagihan">
                            <option value="Kesehatan">
                            <option value="Pendidikan">
                            <option value="Lainnya">
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Wallet Modals -->
@foreach($wallets as $wallet)
<div class="modal fade" id="editWalletModal{{ $wallet->id }}" tabindex="-1" aria-labelledby="editWalletModalLabel{{ $wallet->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('wallets.update', $wallet->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editWalletModalLabel{{ $wallet->id }}">Edit Dompet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Dompet</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $wallet->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="cash" {{ $wallet->type == 'cash' ? 'selected' : '' }}>Uang Tunai</option>
                            <option value="bank" {{ $wallet->type == 'bank' ? 'selected' : '' }}>Rekening Bank</option>
                            <option value="e-wallet" {{ $wallet->type == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="other" {{ $wallet->type == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="balance" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="balance" name="balance" value="{{ $wallet->balance }}" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Warna</label>
                        <input type="color" class="form-control form-control-color w-100" id="color" name="color" value="{{ $wallet->color ?? '#6c757d' }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="2">{{ $wallet->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Edit Transaction Modals -->
@foreach($transactions as $transaction)
<div class="modal fade" id="editTransactionModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="editTransactionModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel{{ $transaction->id }}">Edit Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="{{ $transaction->type }}">

                    <div class="mb-3">
                        <label for="wallet_id" class="form-label">Dompet</label>
                        <select class="form-select" id="wallet_id" name="wallet_id" required>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}" {{ $transaction->wallet_id == $wallet->id ? 'selected' : '' }}>
                                    {{ $wallet->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $transaction->category }}">
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{ $transaction->amount }}" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{ $transaction->transaction_date->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="2">{{ $transaction->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('scripts')
<script>
    // Fix untuk modal z-index
    document.addEventListener('DOMContentLoaded', function() {
        // Mengatur z-index modal secara dinamis untuk memastikan modal selalu berada di atas elemen lain
        const modalElements = document.querySelectorAll('.modal');
        let baseZIndex = 1050;

        modalElements.forEach(function(modal, index) {
            modal.style.zIndex = (baseZIndex + index).toString();

            // Memastikan backdrop juga memiliki z-index yang sesuai
            modal.addEventListener('show.bs.modal', function() {
                setTimeout(function() {
                    const backdrop = document.querySelector('.modal-backdrop:last-child');
                    if (backdrop) {
                        backdrop.style.zIndex = (baseZIndex + index - 1).toString();
                    }
                }, 10);
            });
        });

        // Memastikan modal dapat diakses dengan baik di semua perangkat
        const allModals = document.querySelectorAll('.modal');
        allModals.forEach(function(modal) {
            modal.addEventListener('shown.bs.modal', function() {
                // Memastikan modal dapat diakses sepenuhnya
                modal.style.display = 'block';
                modal.style.overflowY = 'auto';
            });

            // Fix untuk masalah iOS
            if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
                modal.addEventListener('shown.bs.modal', function() {
                    // Fix untuk iOS yang sering menggulir ke atas saat modal terbuka
                    document.body.style.position = 'fixed';
                    document.body.style.width = '100%';
                });

                modal.addEventListener('hidden.bs.modal', function() {
                    document.body.style.position = '';
                    document.body.style.width = '';
                });
            }
        });
    });
</script>
@endsection
