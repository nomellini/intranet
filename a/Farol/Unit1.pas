unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, xmldom, XMLIntf, StdCtrls, msxmldom, XMLDoc, ExtCtrls, jpeg;

type
  TForm1 = class(TForm)
    XMLDocument1: TXMLDocument;
    Timer1: TTimer;
    img0: TImage;
    img1: TImage;
    img2: TImage;
    Image1: TImage;
    lblStatus: TLabel;
    lblTempo: TLabel;
    lblCliente: TLabel;
    procedure Timer1Timer(Sender: TObject);
    procedure FormCreate(Sender: TObject);
  private
    FTemoSegundos: double;
    FStatusID: Integer;
    FTempo: String;
    FStatus: String;
    FCliente: String;
    FTempoSegundos: double;
    { Private declarations }
    procedure teste;
    procedure SetCliente(const Value: String);
    procedure SetStatus(const Value: String);
    procedure SetStatusID(const Value: Integer);
    procedure SetTempo(const Value: String);
    procedure SetTempoSegundos(const Value: double);
  public
    { Public declarations }
    property StatusID: Integer read FStatusID write SetStatusID;
    property Status: String read FStatus write SetStatus;
    property TempoSegundos: double read FTempoSegundos write SetTempoSegundos;
    property Tempo: String read FTempo write SetTempo;
    property Cliente: String read FCliente write SetCliente;
  end;

var
  Form1: TForm1;

implementation

uses StrUtils;

{$R *.dfm}

procedure TForm1.teste;
var
  lTempo: String;
begin

  try
    XMLDocument1.FileName := 'http://10.1.0.1/a/farolxml.php';
    XMLDocument1.Active := true;
    lTempo := XMLDocument1.ChildNodes[1].ChildNodes['temposegundos'].Text;
    lTempo := AnsiReplaceStr(lTempo, '.',',');
    TempoSegundos := StrToFloat(lTempo);
    Tempo := XMLDocument1.ChildNodes[1].ChildNodes['tempotexto'].Text;
    Cliente := XMLDocument1.ChildNodes[1].ChildNodes['clienteid'].Text;
    StatusID := StrToInt(XMLDocument1.ChildNodes[1].ChildNodes['statusid'].Text);
    Status := XMLDocument1.ChildNodes[1].ChildNodes['status'].Text ;
  except
    On E: Exception do
    begin
      Cliente := Copy(E.Message, 1, 20) + '...';
      Status := 'ERRO de XML';
      Tempo := '---';
      TempoSegundos := 0;
    end;
  end;

  lblStatus.Caption := Status;
  lblTempo.Caption := Tempo;
  lblCliente.Caption := Cliente;

  if (TempoSegundos<10) then
  begin
    Image1.Picture := img0.Picture;
  end
  else if (  (TempoSegundos>=10) and (TempoSegundos<20)  ) then
  begin
    Image1.Picture := img1.Picture;
  end else if (TempoSegundos>=20) then
  begin
    Image1.Picture := img2.Picture;
  end;

  XMLDocument1.Active := false;
end;

procedure TForm1.Timer1Timer(Sender: TObject);
begin
  teste;
end;

procedure TForm1.FormCreate(Sender: TObject);
begin
  teste;
end;

procedure TForm1.SetCliente(const Value: String);
begin
  FCliente := Value;
end;

procedure TForm1.SetStatus(const Value: String);
begin
  FStatus := Value;
end;

procedure TForm1.SetStatusID(const Value: Integer);
begin
  FStatusID := Value;
end;

procedure TForm1.SetTempo(const Value: String);
begin
  FTempo := Value;
end;

procedure TForm1.SetTempoSegundos(const Value: double);
begin
  FTempoSegundos := Value;
end;

end.
