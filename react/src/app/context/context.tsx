'use client';

import { getPayments } from '@/lib/api';
import {
  Dispatch,
  ReactNode,
  SetStateAction,
  createContext,
  useContext,
  useEffect,
  useState,
} from 'react';

interface DataContextProps {
  data?: any;
  setData?: Dispatch<SetStateAction<never[]>> | null;
}

interface DataProviderProps {
  children: ReactNode;
}

export const DataContext = createContext<any>({});

export const DataProvider: React.FC<DataProviderProps> = (props) => {
  const [data, setData] = useState({ result: [] });

  useEffect(() => {
    getData();
  }, []);

  const getData = async () => {
    const res = await getPayments();
    const resJson = await res.json();
    setData(resJson.data);
  };

  const values = {
    data,
    setData,
    getData
  };

  return (
    <DataContext.Provider value={values}>{props.children}</DataContext.Provider>
  );
};

export const useDataContext = () => {
  return useContext(DataContext);
};
