'use client';
import * as React from 'react';
import { columns } from '@/lib/columns';
import { DataGrid } from '@mui/x-data-grid';
import { useDataContext } from '@/app/context/context';

export function CustomDataGrid() {
  const { data } = useDataContext();

  return (
    <div style={{ height: '100%', width: '100%', background: 'white' }}>
      <DataGrid rows={data} columns={columns} pageSizeOptions={[5, 10]} />
    </div>
  );
}
