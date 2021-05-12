Imports amzinet

Public Class WebForm1
    Inherits System.Web.UI.Page
    Protected WithEvents SoundListBox As System.Web.UI.WebControls.ListBox
    Protected WithEvents PetTextBox As System.Web.UI.WebControls.TextBox
    Protected WithEvents GetPetButton As System.Web.UI.WebControls.Button
    Protected WithEvents Label1 As System.Web.UI.WebControls.Label
    Dim ls As LogicServer

#Region " Web Form Designer Generated Code "

    'This call is required by the Web Form Designer.
    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()

    End Sub

    Private Sub Page_Init(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Init
        'CODEGEN: This method call is required by the Web Form Designer
        'Do not modify it using the code editor.
        InitializeComponent()
    End Sub

#End Region

    Private Sub Page_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        'Put user code to initialize the page here

    End Sub

    Private Sub GetPetButton_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles GetPetButton.Click
        Dim term As Long
        Dim pet As String
        Dim sound As String

        ls = Session("logicServer")
        Try
            ls.RetractStr("sound(_)")
            sound = "sound(" + SoundListBox.SelectedItem.ToString + ")"
            ls.AssertaStr(sound)
            term = ls.ExecStr("pet(X)")
            pet = ls.GetStrArg(term, 1)
            PetTextBox.Text = pet
        Catch ex As LSException
            Throw New Exception(PetTextBox.Text = ex.GetMsg())
        End Try

    End Sub
End Class
