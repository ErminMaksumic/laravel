'use client';
import * as React from 'react';
import { columnsWithEdit, columns } from '@/lib/columns';
import { DataGrid } from '@mui/x-data-grid';
import { useDataContext } from '@/app/context/context';
import { v4 as uuidv4 } from 'uuid';

export function CustomDataGrid({ params }: any) {
  const { data } = useDataContext();

  return (
    <div style={{ height: '100%', width: '100%', background: 'white' }}>
      {data && data.length > 0 && (
        <DataGrid
          rows={params != undefined && params != '' ? [params] : data}
          columns={
            params != undefined && params != '' ? columns : columnsWithEdit
          }
          pageSizeOptions={[5, 10]}
          getRowId={() => uuidv4()}
        />
      )}
    </div>
  );
}
